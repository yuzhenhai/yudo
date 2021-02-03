var m_sessionInfo = {};
jq(document).ready(function() {
	jq.ajax({
		url: '/JLAMPCommon/getCookieJson_prc',
		type: 'get',
		dataType: 'json',
		async: false,
		success: function(res, status, xhr) {
			if (res) {
				if (res.returnCode == 0) {
					if (res.data.sessionInfo) {
						jq.each(res.data.sessionInfo, function(k, v) {
							Object.defineProperty(m_sessionInfo, k, {
								configurable: false,
								enumerable: false,
								value: v,
								writable: false
							});
						});

						if (!Object.isFrozen(m_sessionInfo))
							Object.freeze(m_sessionInfo);
					}
				}
			}
		}
	});
});
